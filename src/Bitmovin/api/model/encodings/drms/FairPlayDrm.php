<?php


namespace Bitmovin\api\model\encodings\drms;

use JMS\Serializer\Annotation as JMS;

class FairPlayDrm extends AbstractDrm
{
    /**
     * @JMS\Type("string")
     * @var  string
     */
    private $key;
    /**
     * @JMS\Type("string")
     * @var  string
     */
    private $iv;
    /**
     * @JMS\Type("string")
     * @var  string
     */
    private $uri;

    /**
     * AbstractDrm constructor.
     * @param string (32char hex format)                            $key
     * @param string (32char hex format)                            $iv
     * @param string                                                $uri
     * @param \Bitmovin\api\model\encodings\helper\EncodingOutput[] $outputs
     */
    public function __construct($key, $iv, $uri, array $outputs = [])
    {
        parent::__construct($outputs);
        $this->key = $key;
        $this->iv = $iv;
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getIv()
    {
        return $this->iv;
    }

    /**
     * @param string $iv
     */
    public function setIv($iv)
    {
        $this->iv = $iv;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}