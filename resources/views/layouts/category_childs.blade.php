

@foreach($childs as $child)
@if(count($child->childs->all())<1)
    <li class="list-item">
       <a class="nav-link" href="{{route('category.show',['name'=>(new \App\PublicModel())->slug_format($child->name)])}}">{{$child->name}}</a>
    </li>

    @else
    <li class="list-item list-item-has-children">
        <i class="now-ui-icons arrows-1_minimal-left"></i>
        <a class="main-list-item nav-link" href="{{route('category.show',['name'=>(new \App\PublicModel())->slug_format($child->name)])}}">{{$child->name}}</a>
        <ul class="sub-menu nav">
           @include('layouts.category_childs',['childs'=>$child->childs->all()])
        </ul>
    </li>

@endif
@endforeach
