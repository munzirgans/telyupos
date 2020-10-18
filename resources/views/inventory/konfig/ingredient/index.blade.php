@extends('master')
@section('inventory','aktif')
@section('judul',"Ingredients")
@section('ingredient',"active")

@section('konten')
<div class="col-md-9" style="margin:0 auto;">
        <div class="card card-plain">
        <div class="card-header card-header-warning">
            <h4 class="card-title mt-0" style="display:inline">Ingredients</h4>
            <a href="{{route('inventory.config.ingredient.add')}}" style="float:right;color:white;margin-top:12px;margin-right:7px;">
                <i class="material-icons" style="color:white;margin-right:5px;margin-bottom:3px">add_circle</i>Add Ingredient</a>
            <p class="card-category">List of Ingredient</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover">
                <thead class="">
                <th>
                    ID
                </th>
                <th>
                    Ingredient
                </th>
                <th>
                    Actions
                </th>
                </thead>
                <tbody>
                    @foreach($ing as $i)
                    <tr>
                        <td>{{$i->id}}</td>
                        <td>{{$i->name}}</td>
                        <td>
                            <a href="{{route('inventory.config.ingredient.edit',$i->id)}}"><i class="material-icons" style="font-size:20px">edit</i></a>
                            <a href="{{route('inventory.config.ingredient.delete',$i->id)}}" style="margin-left:10px;color:red;"><i class="material-icons" style="font-size:23px">delete_forever</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
@endsection
