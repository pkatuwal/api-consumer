<?php
namespace Pramod\ApiConsumer\Parser;

use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;

class ConsumerParser
{
    protected $consumerSettings;
    protected $consumerRequestSettings;
    
    public function __construct($consumerSettings)
    {
        $this->consumerRequestSettings=$consumerSettings;
        $this->consumerSettings=$this->parseConsumerSettings();
        return $this;
    }

    public function getConsumerSettings()
    {
        return $this->consumerSettings;
    }

    public function getBaseUri()
    {

        if ($this->consumerSettings['baseUri']) return $this->consumerSettings['baseUri'];
        throw new InvalidArgumentException('Invalid BaseUri');
    }

    public function getAppVersion()
    {
        return $this->consumerSettings['version']??null;
    }

    public function getSecret()
    {
        return $this->consumerSettings['secret']??null;
    }
    public function getTimeOut()
    {
        return $this->consumerSettings['timeout']??config('api-consumer.default.timeout');
    }
    public function getSslVerify()
    {
        return $this->consumerSettings['ssl_verification']??config('api-consumer.default.ssl_verification');
    }

    public function loadCustomConsumerSettings()
    {
        if (!empty($this->getCustomConsumer())) {
            foreach ($this->getCustomConsumer() as $row) {
                return Yaml::parseFile(base_path('app').'/'.$row.'.yml');
            }
        }
    }

    public function getRegisteredConsumers()
    {
        return $this->loadCustomConsumerSettings();
    }

    public function getCustomConsumer()
    {
        return $this->consumerSettings['custom_consumer']??[];
    }

    public function getConsumerRequestSetting()
    {
        return $this->consumerRequestSettings;
    }
    protected function parseConsumerSettings()
    {
        return config('api-consumer.consumer.'.$this->consumerRequestSettings);
    }
}
