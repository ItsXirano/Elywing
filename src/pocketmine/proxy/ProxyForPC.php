<?php

namespace Pocketmine\proxy\ProxyForPC;

use Pocketmine\network\NetWork;

use Pocketmine\Achievement;
use Pocketmine\Player;
use PocketminePocketmine\entity\Entity;
use Pocketmine\item\Item;
use Pocketmine\Block\Block;
use Pocketmine\level\Level;
use Pocketmine\network\protocol\AddEntityPacket;
use Pocketmine\network\protocol\AddItemEntityPacket;
use Pocketmine\network\protocol\AddPaintingPacket;
use Pocketmine\network\protocol\AddPlayerPacket;
use Pocketmine\network\protocol\AdventureSettingsPacket;
use Pocketmine\network\protocol\AnimatePacket;
use Pocketmine\network\protocol\ContainerClosePacket;
use Pocketmine\network\protocol\ContainerOpenPacket;
use Pocketmine\network\protocol\ContainerSetContentPacket;
use Pocketmine\network\protocol\ContainerSetDataPacket;
use Pocketmine\network\protocol\ContainerSetSlotPacket;
use Pocketmine\network\protocol\CraftingDataPacket;
use Pocketmine\network\protocol\CraftingEventPacket;
use Pocketmine\network\protocol\DataPacket;
use Pocketmine\network\protocol\DropItemPacket;
use Pocketmine\network\protocol\FullChunkDataPacket;
use Pocketmine\network\protocol\Info;
use Pocketmine\network\protocol\SetEntityLinkPacket;
use Pocketmine\network\protocol\TileEntityDataPacket;
use Pocketmine\network\protocol\EntityEventPacket;
use Pocketmine\network\protocol\ExplodePacket;
use Pocketmine\network\protocol\HurtArmorPacket;
use Pocketmine\network\protocol\InteractPacket;
use Pocketmine\network\protocol\LevelEventPacket;
use Pocketmine\network\protocol\DisconnectPacket;
use Pocketmine\network\protocol\TextPacket;
use Pocketmine\network\protocol\MoveEntityPacket;
use Pocketmine\network\protocol\MovePlayerPacket;
use Pocketmine\network\protocol\PlayerActionPacket;
use Pocketmine\network\protocol\MobArmorEquipmentPacket;
use Pocketmine\network\protocol\MobEquipmentPacket;
use Pocketmine\network\protocol\RemoveBlockPacket;
use Pocketmine\network\protocol\RemoveEntityPacket;
use Pocketmine\network\protocol\RemovePlayerPacket;
use Pocketmine\network\protocol\RespawnPacket;
use Pocketmine\network\protocol\SetDifficultyPacket;
use Pocketmine\network\protocol\SetEntityDataPacket;
use Pocketmine\network\protocol\SetEntityMotionPacket;
use Pocketmine\network\protocol\SetSpawnPositionPacket;
use Pocketmine\network\protocol\TakeItemEntityPacket;
use Pocketmine\network\protocol\TileEventPacket;
use Pocketmine\network\protocol\UpdateBlockPacket;
use Pocketmine\network\protocol\UseItemPacket;
use Pocketmine\math\Vector3;
use Pocketmine\nbt\NBT;
use Pocketmine\tile\Tile;
use Pocketmine\utils\TextFormat;

class ProxyForPC extends NetWork{
  
	const VERSION = "1.9";
	const PROTOCOL = 47;
	
	const CURRENT_PROTOCOL = 47;
	const TARGET_PROTOCOL = 45;
	
	const CURRENT_MINECRAFT_VERSION_NETWORK = "1.9";
	
		public function onEnable(){
		$this->saveDefaultConfig();

		$port = (int) $this->getConfig()->get("port");
		if($port === $this->getServer()->getPort()){
			$this->getLogger()->error("In Config.yml Please edit your Port");
			return;
		}

		if(Info::CURRENT_PROTOCOL !== self::TARGET_PROTOCOL){
			$this->getLogger()->error("Protocol Error");
			return;
		}

		$this->getLogger()->info("Starting Minecraft PC server ".$this->getDescription()->getVersion()." on port $port");
		$interface = new NewInterface($this->getServer(), $port);
		$this->getServer()->getNetwork()->registerInterface($interface);
	}
}// I Have To Upload All
