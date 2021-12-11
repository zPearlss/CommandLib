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

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;

final class CmdManager{
	
	private static bool $registerBool= false;
	
	public static function register(Plugin $plugin) : void{
		if(!self::$registerBool){
			Server::getInstance()->getPluginManager()->registerEvents(new PacketListener(), $plugin);
			self::$registerBool = true;
		}
	}
	
	public static function isRegister() : bool{
		return self::$registerBool;
	}
	
	public function update(Player $player) : void{
		$player->getNetworkSession()->syncAvailableCommands();
	}
	
	public static function updateAll() : void{
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			$player->getNetworkSession()->syncAvailableCommands();
		}
	}
	
}