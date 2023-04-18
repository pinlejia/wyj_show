<?php

namespace App\Modules\Presenters\Brands;

use App\Modules\Transformers\Brands\BrandTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BrandPresenter.
 *
 * @package namespace App\Modules\Presenters;
 */
class BrandPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BrandTransformer();
    }
}
