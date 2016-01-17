@extends('web')

@section('title')
Info
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item active">
                     Captain <span class="badge">{{ $player->name }}</span>
                </li>
                <li class="list-group-item">
                     Reputation <span class="badge">{{ $player->reputation }}</span>
                </li>
                <li class="list-group-item">
                     Alignment <span class="badge">{{ $player->alignment }}</span>
                </li>
                <li class="list-group-item">
                     Affiliation <span class="badge">{{ $player->affiliation }}</span>
                </li>
                <li class="list-group-item">
                    Credits <span class="badge">{{ $player->ship->credits }}</span>
                </li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item active">
                     Ship <span class="badge">{{ $player->ship->name }}</span>
                </li>
                <li class="list-group-item">
                     Class <span class="badge" data-toggle="tooltip" data-placement="right" title="{{ $player->ship->type->description }}">{{ $player->ship->type->name }}</span>
                </li>
                <li class="list-group-item">
                     Structure <span class="badge">{{ $player->ship->structure }}/{{ $player->ship->type->structure }}</span>
                </li>
                <li class="list-group-item">
                     Energy <span class="badge">{{ $player->ship->energy }}/{{ $player->ship->energyCapacity }}</span>
                </li>
                <li class="list-group-item">
                     Unused capacity <span class="badge">{{ $player->ship->type->slots - $player->ship->itemCount }}/{{ $player->ship->type->slots }}</span>
                </li>
                <li class="list-group-item">
                     Shields <span class="badge">{{ $player->ship->shields }}</span>
                </li>
                <li class="list-group-item">
                     Armor <span class="badge">{{ $player->ship->armor }}</span>
                </li>
                <li class="list-group-item">
                     Kinetic weapon power <span class="badge">{{ $player->ship->kinetics }}</span>
                </li>
                <li class="list-group-item">
                     Beam weapon power <span class="badge">{{ $player->ship->beams }}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
