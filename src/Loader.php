<?php

declare(strict_types=1);

namespace IcyEndymion004\FrozenEconomy;

use IcyEndymion004\AspiredGangs\Commands\SubCommands\Admin\AdminAddMoney;
use IcyEndymion004\AspiredGangs\Commands\SubCommands\Admin\AdminClearPlayerMoney;
use IcyEndymion004\AspiredGangs\Commands\SubCommands\Admin\AdminRemoveMoney;
use IcyEndymion004\AspiredGangs\Commands\SubCommands\Admin\OwnerWipeAllMoney;
use IcyEndymion004\FrozenEconomy\Commands\PlayerGetMoney;
use IcyEndymion004\FrozenEconomy\Commands\PlayerSendMoney;
use IcyEndymion004\FrozenEconomy\Commands\PlayerTopMoney;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase implements Listener{

    /** @var self */
    private static $instance;

    /** @var Config */
    protected $economy;
    /** @var Economy */
    protected $api;

    public function onLoad() : void {
        self::$instance = $this;
        $this->api = new Economy();
    }
    public function onEnable(): void
    {
    $this->getLogger()->notice("This Plugin was created By IcyEndymion004 with partnership with pixelated Studio's");
    $this->registercommands();
    $this->getServer()->getPluginManager()->registerEvents(new EventHandler(), $this);
    $this->economy = new Config($this->getDataFolder() . "economydata.yml", Config::YAML);
    }
    /**
     * gets the data file for the economy
     * @return Config
     */
    public static function getEconomy(): Config
    {
        return self::get()->economy;
    }

    /**
     * Returns a instance of loader
     * @return $this
     */
    public static function get() : self {
        return self::$instance;
    }

    public function registercommands(): void{
        //player commands
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new PlayerSendMoney());
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new PlayerGetMoney());
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new PlayerTopMoney());
        //admin commands
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new AdminAddMoney());
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new AdminRemoveMoney());
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new AdminClearPlayerMoney());
        $this->getServer()->getCommandMap()->register("FrozenEconomy", new OwnerWipeAllMoney());
    }
    public function API() : Economy {
        return $this->api;
    }

}
