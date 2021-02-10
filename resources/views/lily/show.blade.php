@extends('app.layout',['title' => 'リリィプロフィール', 'pagetype' => 'back-triangle'])

<?php
    /**
     * @var $lily \App\Models\Lily
     */
?>

@section('head')
    <link rel="stylesheet" href="{{ asset('css/lilyprofile.css') }}">
@endsection

@section('main')
    <main>
        <div id="profile">
            <div class="left">
                <div class="name-plate">
                    <div class="pic"></div>
                    <div class="profile">
                        <div class="name-ruby">{{ $lily->name_y }}</div>
                        <div class="name" style="
                        @if(mb_strlen($lily->name) >= 16) font-size: 24px; @endif">{{ $lily->name }}</div>
                        <div class="summary">
                            <div>誕生日 : {{ $triples['birthday'] ?? 'N/A' }}</div><hr>
                            <div>年齢 : {{ $triples['age'] ?? 'N/A' }}歳</div><hr>
                            <div>血液型 : {{ $triples['bloodType'] ?? 'N/A' }}</div><hr>
                            <div>学年 : {{ !empty($triples['garden.grade']) ? $triples['garden.grade'].'年' : 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                <table id="profile-table">
                    <tbody>
                    @include('app.lilyprofiletable.record',['object' => $triples['garden.name'] ?? '', 'th' => '所属ガーデン'])
                    @if(!empty($triples['garden.position']))
                        @include('app.lilyprofiletable.record',['object' => $triples['garden.position'], 'th' => 'ガーデン役職'])
                    @endif
                    @include('app.lilyprofiletable.record',['object' => $triples['legion.name'], 'th' => '所属レギオン'])
                    @if(!empty($triples['legion.position']))
                        @include('app.lilyprofiletable.record',['object' => $triples['legion.position'], 'th' => 'レギオン役職'])
                    @endif
                    @if(!empty($triples['tacticalPosition']))
                        @include('app.lilyprofiletable.record',['object' => $triples['tacticalPosition'], 'th' => 'ポジション'])
                    @endif
                    @if(!empty($triples['partner.schutzengel']))
                        @include('app.lilyprofiletable.partner',['partner' => $triples['partner.schutzengel'], 'th' => 'シュッツエンゲル'])
                    @endif
                    @if(!empty($triples['partner.schild']))
                        @include('app.lilyprofiletable.partner',['partner' => $triples['partner.schild'], 'th' => 'シルト'])
                    @endif
                    @include('app.lilyprofiletable.record',['object' => $triples['favorite'] ?? null, 'th' => '好きなもの'])
                    @include('app.lilyprofiletable.record',['object' => $triples['notGood'] ?? null, 'th' => '苦手なもの'])
                    @include('app.lilyprofiletable.record2line',['object' => $triples['skill_hobby'] ?? null, 'th' => '特技・趣味'])
                    @include('app.lilyprofiletable.record',['object' => $triples['rareSkill'] ?? null, 'th' => '所持レアスキル'])
                    @if(!empty($triples['subSkill']))
                        @include('app.lilyprofiletable.record',['object' => $triples['subSkill'] ?? null, 'th' => '所持サブスキル'])
                    @endif
                    @if(!empty($triples['boostedSkill']))
                        @include('app.lilyprofiletable.record',['object' => $triples['boostedSkill'] ?? null, 'th' => 'ブーステッドスキル'])
                    @endif
                    @include('app.lilyprofiletable.record',['object' => $triples['charm'] ?? null, 'th' => '主な使用CHARM'])
                    @if(!empty($lily->color))
                        <tr>
                            <th>カラーコード</th>
                            <td style="font-weight: bold; color: {{ $lily->color }}">{{ $lily->color }}</td>
                        </tr>
                    @endif
                    @if(!empty($triples['cast']))
                        @include('app.lilyprofiletable.record',['object' => $triples['cast'] ?? null, 'th' => 'キャスト'])
                    @endif
                    @if(!empty($triples['remarks']))
                        @include('app.lilyprofiletable.record2line',['object' => $triples['remarks'] ?? null, 'th' => '特記事項'])
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="right" style="width: 100%;position: relative">
                @if(!empty($triples['KIA']))
                    <div class="KIA">{{ $triples['KIA'] }}<br>戦死・殉職者</div>
                @endif
                <div id="pics">
                    <div style="text-align: center; padding-top: 130px; color: gray; font-size: large;">Image Unavailable</div>
                </div>
            </div>
        </div>
    </main>
@endsection
