<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Printful\Exceptions\PrintfulApiException;
use Printful\Exceptions\PrintfulException;
use Printful\PrintfulApiClient;
use Printful\PrintfulProducts;
use Printful\Structures\Sync\Responses\SyncProductsResponse;

class PrintFulController extends Controller
{
    public function get_products()
    {
      // Replace this with your API key
  $apiKey = 'O58NA5rVmO57OnXkb7TyYAKsCxOKmLFBiFlWCYCZ';

  // create ApiClient
  $pf = new PrintfulApiClient($apiKey);
  // dd($pf);
  // create Products Api object
  $productsApi = new PrintfulProducts($pf);
  // dd($productsApi);
  // set some paging info
  $offset = 0;
  $limit = 20;
  //
  // /** @var SyncProductsResponse $list */
  $list = $productsApi->getProducts($offset, $limit);
        dd($list);
      }
}
