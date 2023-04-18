<?php

namespace App\Modules\Transformers\Brands;

use App\Modules\Entities\Brands\Brand;
use League\Fractal\TransformerAbstract;

/**
 * Class BrandTransformer.
 *
 * @package namespace App\Modules\Transformers;
 */
class BrandTransformer extends TransformerAbstract
{
    /**
     * Transform the Brand entity.
     *
     * @param \App\Modules\Entities\Brands\Brand $model
     *
     * @return array
     */
    public function transform(Brand $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
