<?php

namespace App\Http\Controllers;
use Okipa\LaravelBootstrapTableList\TableList;
use Illuminate\Http\Request;

use App\offer;
class publisherController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function home(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.home');
    }

    public function account(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.account');
    }
    public function dashboard(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.home');
    }
    public function offerSubscribed(Request $request, $id){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.home');
    }
    public function offerStats(Request $request, $id){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.home');
    }
    public function support(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.support');
    }
    public function statistics(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.statistics');
    }


    public function offer(Request $request, $id){
        $request->user()->authorizeRoles('publisher');

        $offer = offer::where('id',$id)->first();

        $data['price'] = $offer->payout;
        $data['title'] = $offer->title;
        $data['promo'] = $offer->promo;
        $data['thumbnail'] = $offer->thumbnail;
        $data['description'] = $offer->description;

        return view('publisher.offer')->with('data',$data);
    }


    public function offers(Request $request){
        $request->user()->authorizeRoles('publisher');

// we instantiate a table list in the news controller
        $table = app(TableList::class)
            ->setModel(Offer::class)
            ->setRoutes([
                'index' => ['alias' => 'publisher-offers', 'parameters' => []],
            ])
            ->addQueryInstructions(function ($query) {
                $query->select('offers.*')
                    ->where('is_private', false);
            });


        $table->addColumn('id')
            ->isSearchable()
            ->isSortable()
            ->setTitle('ID')
            ->sortByDefault();

        $table->addColumn('title')
            ->setTitle('Title')
            ->isSortable()
            ->setStringLimit(25)
            ->isSearchable();

        $table->addColumn()
            ->setTitle(__('Clicks'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>". $entity->id . "</b>";
            });
        $table->addColumn()
            ->setTitle(__('Subscribes'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>". $entity->id . "</b>";
            });

        $table->addColumn()
            ->setTitle(__('Today $'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>$". $entity->id . "</b>";
            });


        $table->addColumn()
            ->setTitle(__('Life Time $'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>$". $entity->id . "</b>";
            });

        $table->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {
                $preview_route = route('preview', ['id' => $entity->id, 'n' => 'a']);
                $promote_route = route('promote-offer', ['id' => $entity->id]);
                $stats_route = route('offer-stats', ['id' => $entity->id]);
                $download_route = route('offer-subscribed', ['id' => $entity->id]);


                return "
<a class='p-3' target='blank' href='$preview_route' title='Preview Offer'><i class='fas fa-fw fa-eye'></i></a>
<a class='p-3' target='blank' href='$stats_route'  title='Show Offer Statistics'><i class='fas fa-fw fa-chart-bar'></i></a>
<a class='p-3' target='blank' href='$promote_route'  title='Show Promotional Links & Tools'><i class='fas fa-fw fa-link'></i></a>
<a class='p-3' target='blank' href='$download_route'  title='Download Subscribed E-mail List'><i class='fas fa-fw fa-arrow-down'></i></a>
                        
                        ";
            });


        return view('publisher.offers')->with('table',$table);
    }


    public function subscribers(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.subscribers');
    }



}
