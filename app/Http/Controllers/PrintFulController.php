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
  try {
      // create ApiClient
      $pf = new PrintfulApiClient($apiKey);

      // create Products Api object
      $productsApi = new PrintfulProducts($pf);

      // set some paging info
      $offset = 0;
      $limit = 20;
  
      /** @var SyncProductsResponse $list */
      $list = $productsApi->getProducts($offset, $limit);

  } catch (PrintfulApiException $e) { // API response status code was not successful
      echo 'Printful API Exception: ' . $e->getCode() . ' ' . $e->getMessage();
  } catch (PrintfulException $e) { // API call failed
      echo 'Printful Exception: ' . $e->getMessage();
      var_export($pf->getLastResponseRaw());
  }
      }
}
