<?php

require_once "Map.php";

class MapSecond extends Map
{
    /**
     * @param $region
     * @return array|null
     */
    public function getPointCenter($region)
    {
        switch ($region) {
            case self::REGION_EUROPE:
                return [439, 158];

            case self::REGION_AFRICA:
                return [462, 282];

            case self::REGION_ASIA:
                return [612, 204];

            case self::REGION_AUSTRALIA:
                return [722, 340];

            case self::REGION_AMERICA:
                return [243, 325];

            case self::REGION_NORTH_AMERICA:
                return [144, 169];

            default:
                return null;
        }
    }

    /**
     * @param string $region
     * @return array|null
     */
    public function getTextCoordinates($region)
    {
        switch ($region) {
            case self::REGION_EUROPE:
                return [439, 164];

            case self::REGION_AFRICA:
                return [462, 288];

            case self::REGION_ASIA:
                return [612, 210];

            case self::REGION_AUSTRALIA:
                return [722, 346];

            case self::REGION_AMERICA:
                return [243, 331];

            case self::REGION_NORTH_AMERICA:
                return [144, 175];

            default:
                return null;
        }
    }

    /**
     * @param string $region
     * @return string|null
     */
    public function getPointClass($region)
    {
        switch ($region) {
            case self::REGION_EUROPE:
                return 'europe';

            case self::REGION_AFRICA:
                return 'africa';

            case self::REGION_ASIA:
                return 'asia';

            case self::REGION_AUSTRALIA:
                return 'australia';

            case self::REGION_AMERICA:
                return 'samerica';

            case self::REGION_NORTH_AMERICA:
                return 'namerica';

            default:
                return null;
        }
    }

    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return 'second_map';
    }

    /**
     * @return array
     */
    public function getViewParams()
    {

        $results = $this->getResults();

        $result = [];
        foreach ($results as $region_key => $region_name) {
            $result[$region_key] = [
                'point_center' => $this->getPointCenter($region_key),
                'point_class' => $this->getPointClass($region_key),
                'text_position' => $this->getTextCoordinates($region_key),
                'value' => $region_name,
            ];
        }

        return [
            'regions' => $result
        ];
    }
}