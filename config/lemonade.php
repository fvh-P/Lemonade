<?php

return [

    /* Application Version */
    'version' => '9.0.0 Shichirigahama',

    'webhooks' => [
        'discord-log' => env('DISCORD_URL'),
    ],

    'mastodon' => [
        'server' => 'https://mstdn.miyacorata.net',
        'account' => '@assaultlily',
        'accessToken' => env('MASTODON_TOKEN'),
        'tootVisibility' => env('MASTODON_VISIBILITY', 'public'),
    ],

    'developer' => [
        'twitter' => 'miyacorata',
        'github' => 'miyacorata'
    ],
    'repository' => 'https://github.com/miyacorata/lemonade',

    'rdf' => [
        'repository' => 'https://github.com/fvh-P/assaultlily-rdf',
    ],

    'officialUrls' => [
        'acus' => 'https://www.assaultlily.com/character/{no}.html/',
        'anime' => 'https://anime.assaultlily-pj.com/character/{slug}',
        'lb' => 'https://assaultlily.bushimo.jp/character/{slug}/',
    ],

    'specialLegion' => [
        'anime' => ['lilyrdf:Radgrid'],
        'lb' => ['lilyrdf:Radgrid', 'lilyrdf:Hervarar', 'lilyrdf:Gran_Eple'],
    ],

    'fumi' => [
        'twitter' => 'assault_lily',
    ],

    'statusPageUrl' => env('STATUS_PAGE_URL'),

    'sparqlEndpoint' => env('SPARQL_ENDPOINT','http://localhost:3030'),

    'rdfPrefix' => [
        'schema' => 'http://schema.org/',
        'rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
        'rdfs' => 'http://www.w3.org/2000/01/rdf-schema#',
        'lily' => 'https://lily.fvhp.net/rdf/IRIs/lily_schema.ttl#',
        'lilyrdf' => 'https://lily.fvhp.net/rdf/RDFs/detail/',
        'foaf' => 'http://xmlns.com/foaf/0.1/',
    ],

    'contractSister' => [
        '私立百合ヶ丘女学院' => [
            'younger' => 'シルト',
            'older' => 'シュッツエンゲル'
        ],
        '私立ルドビコ女学院' => 'シュベスター',
        '柳都女学館' => 'グリンカムビの誓い',
        '聖メルクリウスインターナショナルスクール' =>[
            'younger' => '貴婦人(アデルハイト)',
            'older' => '騎士(リッター)'
        ],
        'エレンスゲ女学園' => '楯の乙女',
    ],

    'dictionaryGUID' => env('DICTIONARY_GUID'),
];
