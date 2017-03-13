<?php


namespace Bitmovin\api\factories\filter;


use Bitmovin\api\ApiClient;
use Bitmovin\api\model\encodings\Encoding;
use Bitmovin\api\model\encodings\streams\Stream;
use Bitmovin\api\model\filters\AbstractFilter;
use Bitmovin\api\model\filters\WatermarkFilter;
use Bitmovin\api\model\filters\DeinterlaceFilter;
use Bitmovin\configs\filter\WatermarkFilterConfig;
use Bitmovin\configs\filter\DeinterlaceFilterConfig;

class FilterFactory
{

    /**
     * @param Encoding  $encoding
     * @param Stream    $stream
     * @param           $abstractFilterConfigs
     * @param ApiClient $apiClient
     */
    public static function createFilterForStream(Encoding $encoding, Stream $stream, $abstractFilterConfigs, ApiClient $apiClient)
    {
        if (!is_array($abstractFilterConfigs))
            return;
        /** @var AbstractFilter[] $apiFilters */
        $apiFilters = array();
        foreach ($abstractFilterConfigs as $abstractFilterConfig)
        {
            if ($abstractFilterConfig instanceof WatermarkFilterConfig) {
                $apiFilters[] = self::createWatermarkFilterForStream($abstractFilterConfig, $apiClient);
            }
            if ($abstractFilterConfig instanceof DeinterlaceFilterConfig) {
                $apiFilters[] = self::createDeinterlaceFilterForStream($abstractFilterConfig, $apiClient);
            }
        }
        if (sizeof($apiFilters) > 0)
            $apiClient->encodings()->streams($encoding)->addFilter($stream, $apiFilters);
    }

    private static function createWatermarkFilterForStream(WatermarkFilterConfig $watermarkFilterConfig, ApiClient $apiClient)
    {
        $watermarkFilter = new WatermarkFilter();
        $watermarkFilter->setBottom($watermarkFilterConfig->bottom);
        $watermarkFilter->setTop($watermarkFilterConfig->top);
        $watermarkFilter->setRight($watermarkFilterConfig->right);
        $watermarkFilter->setLeft($watermarkFilterConfig->left);
        $watermarkFilter->setImage($watermarkFilterConfig->image);
        return $apiClient->filters()->watermark()->create($watermarkFilter);
    }

    private static function createDeinterlaceFilterForStream(DeinterlaceFilterConfig $deinterlaceFilterConfig, ApiClient $apiClient)
    {
        $deinterlaceFilter = new DeinterlaceFilter();
        $deinterlaceFilter->setMode($deinterlaceFilterConfig->mode);
        $deinterlaceFilter->setParity($deinterlaceFilterConfig->parity);
        return $apiClient->filters()->deinterlace()->create($deinterlaceFilter);
    }

}