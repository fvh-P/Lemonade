<?php

namespace App\Http\Controllers;

use App\Models\Triple;

class LilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $triples_sparql = sparqlQueryOrDie(<<<SPQRQL
PREFIX lilyrdf: <https://lily.fvhp.net/rdf/RDFs/detail/>
PREFIX lily: <https://lily.fvhp.net/rdf/IRIs/lily_schema.ttl#>
PREFIX schema: <http://schema.org/>

SELECT ?subject ?predicate ?object
WHERE {
  ?subject a ?type;
           ?predicate ?object.
  FILTER(?type IN(lily:Lily, lily:Legion))
}
SPQRQL
);
        $triples = sparqlToArray($triples_sparql);

        $lilies = array();
        $legions = array();

        // レギオンとリリィの振り分け
        foreach ($triples as $key => $triple){
            if($triple['rdf:type'][0] === 'lily:Lily'){
                $lilies[$key] = $triple;
            }else{
                $legions[$key] = $triple;
            }
        }

        // リリィソート用キー配列の作成
        $lily_sortKey = array();
        foreach ($lilies as $lily){
            $lily_sortKey[] = $lily['lily:nameKana'][0] ?? '-';
        }
        // リリィのソート
        array_multisort($lily_sortKey, SORT_ASC, SORT_STRING, $lilies);

        return response()->view('lily.index', compact('lilies', 'legions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
    //    //
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    //{
    //    //
    //}

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $rdf_error = null;

        $triples_sparql = sparqlQueryOrDie(<<<SPARQL
PREFIX lilyrdf: <https://lily.fvhp.net/rdf/RDFs/detail/>
PREFIX lily: <https://lily.fvhp.net/rdf/IRIs/lily_schema.ttl#>

SELECT ?subject ?predicate ?object
WHERE {
  {
    lilyrdf:$slug ?predicate ?object.
    BIND(lilyrdf:$slug AS ?subject)
  }
  UNION
  {
    lilyrdf:$slug ?rp ?ro.
    FILTER(!isLiteral(?ro)).
    ?ro ?predicate ?object.
    BIND(?ro as ?subject)
  }
  UNION
  {
    lilyrdf:$slug lily:charm/lily:resource ?charm.
    ?charm ?cp ?co.
    BIND(?charm as ?subject)
    BIND(?cp as ?predicate)
    BIND(?co as ?object)
  }
}
SPARQL
);
        $triples = sparqlToArray($triples_sparql);

        if(empty($triples)) abort(404, '該当するリリィのデータが存在しません');

        $triples_model = Triple::whereLilySlug($slug)->get();
        foreach ($triples_model as $triple){
            $triples['lilyrdf:'.$slug][$triple->predicate] = $triple->object;
        }

        return view('lily.show', compact('triples', 'slug', 'rdf_error'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function edit($id)
    //{
    //    //
    //}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    //{
    //    //
    //}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    //{
    //    //
    //}
}
