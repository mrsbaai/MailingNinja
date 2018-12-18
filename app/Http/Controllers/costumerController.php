<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\costumerProducts;

class costumerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function home(request $request){
        $request->user()->authorizeRoles('costumer');
        $table = app(TableList::class)
            ->setModel(Offer::class)
            ->setRoutes([
                'index' => ['alias' => 'publisher-offers', 'parameters' => []],
            ])
            ->addQueryInstructions(function ($query) {
                $query->select('costumerProducts.*');

                $query->where('costumer_id', Auth::user()->id);
            });


        $table->addColumn('id')
            ->isSearchable()
            ->isSortable()
            ->setTitle('ID')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->is_private == false){
                    return $entity->id;
                }else{
                    if(publisherOffers::where('publisher_id', Auth::user()->id)->where('offer_id', $entity->id)->first()){
                        return $entity->id;
                    }else{
                        return "Disabled";
                    }
                }

            })
            ->sortByDefault();

        $table->addColumn('title')
            ->setTitle('Offer')
            ->isSearchable()
            ->isCustomHtmlElement(function ($entity, $column) {

                $promote_route = route('promote-offer', ['id' => $entity->id]);
                $return = "<b><a href='$promote_route' target='blank'>". $entity->title . "</a></b>";
                if ($entity->is_private == true){
                    if(publisherOffers::where('publisher_id', Auth::user()->id)->where('offer_id', $entity->id)->first()){
                        return $return;
                    }else{
                        return $entity->title;
                    }
                }else{
                    return $return;
                }

            });


        $table->addColumn('')
            ->setTitle(__('Subscribes'))
            ->isCustomHtmlElement(function ($entity, $column) {
                $query  = subscriber::latest();
                $query->where('user_id', Auth::user()->id)->where('offer_id', $entity->id);
                $return = "<b>".  count($query->get()) . "</b>";
                if ($entity->is_private == true){
                    if(publisherOffers::where('publisher_id', Auth::user()->id)->where('offer_id', $entity->id)->first()){
                        return $return;
                    }else{
                        return "Disabled";
                    }
                }else{
                    return $return;
                }
            });


        $table->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {

                $preview_route = route('preview', ['id' => $entity->id, 'n' => 'a']);
                $promote_route = route('promote-offer', ['id' => $entity->id]);
                $stats_route = route('offer-stats', ['id' => $entity->id]);
                $download_route = route('offer-subscribed', ['id' => $entity->id]);

                $return =   "
<a class='p-3' target='blank' href='$preview_route' title='Preview Offer'><i class='fas fa-fw fa-eye'></i></a>
<a class='p-3' target='blank' href='$stats_route'  title='Show Offer Statistics'><i class='fas fa-fw fa-chart-bar'></i></a>
<a class='p-3' target='blank' href='$promote_route'  title='Show Promotional Links & Tools'><i class='fas fa-fw fa-link'></i></a>
<a class='p-3' target='blank' href='$download_route'  title='Download Subscribed E-mail List'><i class='fas fa-fw fa-arrow-down'></i></a>
                        
                        ";

                if ($entity->is_private == true){
                    if(publisherOffers::where('publisher_id', Auth::user()->id)->where('offer_id', $entity->id)->first()){
                        return $return;
                    }else{
                        return "Disabled";
                    }
                }else{
                    return $return;

                }


            });


        return view('costumer.home')->with('table',$table);
    }
    public function contact(request $request){
        $request->user()->authorizeRoles('costumer');
        return view('costumer.contact');
    }

}
