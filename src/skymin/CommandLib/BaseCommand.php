<?php
/**
 *      _                    _       
 *  ___| | ___   _ _ __ ___ (_)_ __  
 * / __| |/ / | | | '_ ` _ \| | '_ \ 
 * \__ \   <| |_| | | | | | | | | | |
 * |___/_|\_\\__, |_| |_| |_|_|_| |_|
 *           |___/ 
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License. see <https://opensource.org/licenses/MIT>.
 * 
 * @author skymin
 * @link   https://github.com/sky-min
 * @license https://opensource.org/licenses/MIT MIT License
 * 
 *   /\___/\
 * 　(∩`・ω・)
 * ＿/_ミつ/￣￣￣/
 * 　　＼/＿＿＿/
 *
 */
 
declare(strict_types = 1);

namespace skymin\CommandLib;

use pocketmine\command\Command;
use pocketmine\lang\Translatable;
use pocketmine\network\mcpe\protocol\types\command\CommandParameter;

use function array_values;

abstract class BaseCommand extends Command{
	
	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [], private array $overloads = []){
		if(!CmdManager::isRegister()){
			throw new \LogicException('Tried creating menu before calling ' . CmdManager::class . ' register');
		}
		parent::__construct($name, $description, $usageMessage, $aliases);
	}
	
	final public function addParameter(CommandParameter $parameter, int $overloadIndex = 0) : void{
		$this->overloads[$overloadIndex][] = $parameter;
	}
	
	final public function setParameter(CommandParameter $parameter, int $parameterIndex, int $overloadIndex = 0) : void{
		$this->overloads[$overloadIndex][$parameterIndex] = $parameter;
	}
	
	final public function setParameters(array $parameters, int $overloadIndex = 0) : void{
		$this->overloads[$overloadIndex] = array_values($parameters);
	}
	
	final public function hasOverloads() : bool{
		if($this->overloads === []){
			return false;
		}
		return true;
	}
	
	final public function getOverloads() : array{
		return $this->overloads;
	}
	
}