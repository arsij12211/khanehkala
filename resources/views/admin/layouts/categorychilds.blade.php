


@if(!empty($category->childs))

    <ul class="treeview-menu">

        @foreach($category->childs->all() as $child)
            @if(count($child->childs->all())<1)
                <li><a href="#"><i class="fa fa-circle-o"></i>{{$child->name}}</a></li>

            @else
                <li class="treeview">

                    <a style="cursor: pointer"><i class="fa fa-circle-o"></i><span style="cursor: pointer" class="badge" onclick="redirect('{{route('category.show',['name'=>(new \App\PublicModel())->slug_format($child->name)])}}')"> {{$child->name}}</span>

                        <span class="pull-left-container">
                        <i class="fa fa-angle-right pull-left"></i>
                      </span>
                    </a>
                    @include('admin.layouts.categorychilds',['category'=>$child])
                </li>
            @endif


       @endforeach

    </ul>
@endif


