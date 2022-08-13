@php
$categories = App\Models\Category::orderBy('category_name_pt', 'ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>

        Categorias

    </div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">

            @foreach ($categories as $category)
                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="#" aria-hidden="true"></i>

                        {{ $category->category_name_pt }}

                    </a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">

                                <!-- Relacionar a subcategoria com a fk categoria; quando bater com a categoria id, então, order by ascendente -->
                                @php
                                    $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                        ->orderBy('subcategory_name_pt', 'ASC')
                                        ->get();
                                @endphp

                                @foreach ($subcategories as $subcategory)
                                    <div class="col-sm-12 col-md-3">

                                        {{-- <!-- Url redirecionamento para descrição produto: declare a url, 
                                            depois passe a id subcategoria concatenada(.) com o nome produto 
                                            user friendly (slug) --> --}}
                                        <a
                                            href="{{ url('subcategory/product/' . $subcategory->id . '/' . $subcategory->subcategory_slug_pt) }}">
                                            <h2 class="title">

                                                {{ $subcategory->subcategory_name_pt }}

                                            </h2>
                                        </a>

                                        <!-- Relacionar a subsubcategoria com a fk subcategoria; quando bater com a subcategoria id, então, order by ascendente -->
                                        @php
                                            $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)
                                                ->orderBy('subsubcategory_name_pt', 'ASC')
                                                ->get();
                                        @endphp

                                        @foreach ($subsubcategories as $subsubcategory)
                                            <ul class="links list-unstyled">
                                                <li>
                                                    <a
                                                        href="{{ url('subsubcategory/product/' . $subsubcategory->id . '/' . $subsubcategory->subsubcategory_slug_pt) }}">

                                                        {{ $subsubcategory->subsubcategory_name_pt }}

                                                    </a>
                                                </li>

                                            </ul>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
