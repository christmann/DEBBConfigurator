<?php

namespace Debb\ConfigBundle\Utilities;

/**
 * Class Subversion
 * @package Debb\ConfigBundle\Utilities
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class Subversion
{
	/**
	 * @var bool|string false if we shouldnt use svn or the path as string if we can use it
	 */
	private $svnPath = false;

	/**
	 * @var null|string the url of svn repository
	 */
	private $svnUrl = null;

	/**
	 * @var string the master key which used in front of each key
	 */
	private $masterKey = '';

	/**
	 * @var array a array with non-commited messages
	 */
	private $commitMessages = array();

	/**
	 * @param bool $svnPath false if we shouldnt use svn or the path as string if we can use it
	 */
	function __construct($svnPath = false, $svnUrl = null)
	{
		$this->setSvnPath(is_bool($svnPath) ? $svnPath : realpath($svnPath));
		$this->setSvnUrl($svnUrl);
		$this->update();
	}

	/**
	 * @param boolean|string $svnPath false if we shouldnt use svn or the path as string if we can use it
	 */
	public function setSvnPath($svnPath)
	{
		$this->svnPath = $svnPath;
	}

	/**
	 * @return string|boolean false if we shouldnt use svn or the path as string if we can use it
	 */
	public function getSvnPath()
	{
		return $this->svnPath == null ? false : $this->svnPath;
	}

	/**
	 * @param null|string $svnUrl
	 */
	public function setSvnUrl($svnUrl)
	{
		$this->svnUrl = $svnUrl;
	}

	/**
	 * @return null|string
	 */
	public function getSvnUrl()
	{
		return $this->svnUrl;
	}

	/**
	 * @param string $masterKey
	 */
	public function setMasterKey($masterKey)
	{
		$this->masterKey = $masterKey;
	}

	/**
	 * @return string
	 */
	public function getMasterKey()
	{
		return (string) $this->masterKey;
	}

	/**
	 * @param string|array $commitMessages
	 */
	public function addCommitMessages($commitMessages)
	{
		if(is_array($commitMessages))
		{
			$this->commitMessages = array_merge($this->commitMessages, $commitMessages);
		}
		else
		{
			$this->commitMessages[] = $commitMessages;
		}
	}

	/**
	 * @param array $commitMessages
	 */
	public function setCommitMessages($commitMessages = array())
	{
		$this->commitMessages = $commitMessages;
	}

	/**
	 * @return array
	 */
	public function getCommitMessages()
	{
		return $this->commitMessages;
	}

	/**
	 * Conevrt a key to a path
	 *
	 * @param $key the key to replace
	 * @return mixed the replaced path
	 */
	public function keyToPath($key)
	{
		return str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $this->getMasterKey() . $key);
	}

	/**
	 * @param string $key the file key - where should we save the file?
	 * @param string $file the file or if !$isPath the file content
	 * @param bool $isPath is the $file a file path (true) or a file content (false)?
	 * @param array|string $extraMessage an array with more informations about the commit (for example the user name etc.)
	 * @return bool true if the file was uploaded to svn or false if not
	 */
	public function set($key, $file, $isPath = true, $commit = true, $extraMessage = array())
	{
		if(!$this->getSvnPath())
		{
			return false;
		}
		if(!is_array($extraMessage))
		{
			$extraMessage = array((string) $extraMessage);
		}
		$key = $this->keyToPath($key);
		$destination = $this->getSvnPath() . DIRECTORY_SEPARATOR . $key;
		@mkdir(dirname($destination), 0777, true); // ignore the warning ...
		if($isPath && !file_exists($file))
		{
			return false;
		}
		if($isPath ? copy($file, $destination) : file_put_contents($destination, $file))
		{
			exec('cd ' . escapeshellarg($this->getSvnPath())
			 . ' && svn add --force *');
			$commitMsg = array_merge(array('Added "' . $key . '"'), $extraMessage);
			if($commit)
			{
				return $this->commit($commitMsg);
			}
			$this->addCommitMessages($commitMsg);
			return true;
		}
		return false;
	}

	/**
	 * @param string $key the file key - where should we save the file?
	 * @param array|string $extraMessage an array with more informations about the commit (for example the user name etc.)
	 * @return bool true if the file was uploaded to svn or false if not
	 */
	public function delete($key, $commit = true, $extraMessage = array())
	{
		if(!$this->getSvnPath())
		{
			return false;
		}
		if(!is_array($extraMessage))
		{
			$extraMessage = array((string) $extraMessage);
		}
		$key = $this->keyToPath($key);
		$destination = $this->getSvnPath() . DIRECTORY_SEPARATOR . $key;
		exec('cd ' . escapeshellarg($this->getSvnPath())
		. ' && svn delete ' . $destination);
		$commitMsg = array_merge(array('Deleted "' . $key . '"'), $extraMessage);
		if($commit)
		{
			return $this->commit($commitMsg);
		}
		$this->addCommitMessages($commitMsg);
		return true;
	}

	/**
	 * @param array|string $extraMessage an array with more information's about the commit (for example the user name etc.)
	 * @param bool $onlyExtraMessage should we only use the $extraMessage parameter for the commit message?
	 * @return bool true if the file was uploaded to svn or false if not
	 */
	public function commit($extraMessage = array(), $onlyExtraMessage = false)
	{
		if(!$this->getSvnPath())
		{
			return false;
		}
		$messages = $onlyExtraMessage ? $extraMessage : array_merge($extraMessage, $this->getCommitMessages());
		$result = exec('cd ' . escapeshellarg($this->getSvnPath())
		. ' && svn commit ' . escapeshellarg($this->getSvnPath()) . ' -m ' . escapeshellarg(implode("\n", $messages)));
		$this->setCommitMessages();
		return (bool) preg_match('#Committed revision [0-9]+.#i', $result);
	}

	/**
	 * Updates the svn directory
	 *
	 * @return bool|string the response of exec command or false if the svn path is not correct
	 */
	public function update()
	{
		if(!$this->getSvnPath())
		{
			return false;
		}
		return exec('cd ' . escapeshellarg($this->getSvnPath())
		. ' && svn update');
	}

	/**
	 * @param $key
	 * @return bool|string
	 */
	public function url($key)
	{
		if($this->getSvnUrl() === false)
		{
			return false;
		}
		return $this->getSvnUrl() . (in_array(substr($this->getSvnUrl(), -1), array('/', '\\')) ? '' : '/') . $key;
	}
}