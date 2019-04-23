<?php

namespace App\Http\Controllers\Web;

use App\Model\referral;

use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;

class ExcelImports implements FromQuery
{

	use Exportable;

	protected $category;

	public function __construct(string $category)
    {

        $this->category = $category;

    }

	public function query()
    {

    	return referral::query()->where('category',$this->category);

    }

}

?>