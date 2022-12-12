<script>
    var larafy = function(table, options) {

        $this = $(table);

        // get table parent ( to add the form inside it then move table to the form)
        var parent = $this.parent();

        // php balde settings

        @php
        if(isset($enableAddRoute)){
                $addRoute = route(str_replace("index" , "create" , Route::currentRouteName()));
            }else{
                $addRoute = false;
            }
        @endphp

        // defaults
        var settings = $.extend({
            route: '{{ route(Route::currentRouteName() , Route::current()->parameters()) }}',
            title: false,
            addRoute: '{{ $addRoute }}',
            search: true,
            sort: true,
            filter: true,
            paginate: true,
            perPage: true,
            showCount: true,
        }, options);

        // create the form
        var form = $('<form>', {
            action: settings.route,
            method: 'GET'
        });
        // add title to parent
        if (settings.title) {
            form.append('<h3 class="title-5 m-b-35 m-t-30">@yield('title')</h3>');
        }
        // add toolbar with search and add to parent
        if (settings.search || settings.add) {

            var toolbar = $('<div class="table-data__tool m-t-30">   </div>');



            if(settings.search){
                var searchInput = '<div class="col-4 text-left p-0"> <div class="form-header"> <input class="au-input" type="text" name="search" value="{{ old('search') }}" placeholder="@lang('placeholders.search')"> <button data-toggle="tooltip" data-placement="top" title="@lang('buttons.search')" class="au-btn--submit" type="submit"> <i class="zmdi zmdi-search"></i> </button> </div> </div>';
                toolbar.append(searchInput);
            }

            if(settings.filter){
                var filterToolbar = $('<div class="col-6 row p-0"></div>');
                @foreach (session('filtersRelation') as $index => $filter)
                     filterToolbar.append(`<div class="col-4 p-0 text-left"><select name="filterByRelation[{{$index}}]" class="form-control"><option value=null>@lang('labels.'.$index.'_filter')</option>@foreach ($filter as $filterItem) <option {{ array_key_exists($index , old('filterByRelation') ?? []) ? (old('filterByRelation')[$index] == $filterItem->id ? 'selected' : '') : ''}} value="{{$filterItem->id}}">{{$filterItem->name}}</option> @endforeach</select></div>`);
                @endforeach
                toolbar.append(filterToolbar);
            }


            if(settings.addRoute){
                var addBtn = '<div class="col-2 text-right p-0"> <a href="'+settings.addRoute+'" class="au-btn au-btn-icon au-btn--green au-btn--small"> <i class="zmdi zmdi-plus"></i>@lang('buttons.add')</a> </div>';
                toolbar.append(addBtn);
            }

            form.append(toolbar);

        }
        // move the table inside the form
        form.append($this);
        // add bottom toolbar with paginate , show count and perPage to parent
        if (settings.paginate || settings.perPage || settings.showCount) {

            var bottomToolbar = $('<div class="row m-t-10 m-b-70"></div>');

            if(settings.paginate){
                var paginator = '<div class="col">{{ $items->onEachSide(2)->appends(request()->query())->links() }}</div>';
                bottomToolbar.append(paginator);
            }
            if(settings.showCount){
                var showCount = '<div class="col-2 text-right"> <p>@lang('labels.show') {{ $items->currentPage() * $items->perPage() > $items->total() ? $items->total() : $items->currentPage() * $items->perPage() }} @lang('labels.from') {{ $items->total() }}</p> </div>';
                bottomToolbar.append(showCount);
            }
            if(settings.perPage){
                var perPage = ' <div class="col-2 text-right"><select class="form-control" id="perPage" name="perPage"><option value="5" {{ request()->query('perPage') == 5 ? 'selected' : '' }}>5</option> <option value="10" {{ request()->query('perPage') == 10 ? 'selected' : '' }}>10</option> <option value="50" {{ request()->query('perPage') == 50 ? 'selected' : '' }}>50</option> <option value="100" {{ request()->query('perPage') == 100 ? 'selected' : '' }}>100</option> </select>  </div>';
                bottomToolbar.append(perPage);
            }

            form.append(bottomToolbar);

        }

        form.find('#perPage').change(function() {
                form.submit()//find(':submit').click();
        });

        // add filter
        // if(settings.filter){
        //         form.find('.filter-relation').each(function(index , val){
        //             var filterByRelationName = $(val).data('name');
        //             console.log(filterByRelationName);
        //             form.append(`<input name="filterByRelation[]" id="filter_${filterByRelationName}" value="${filterByRelationName}" type="hidden" >`);
        //         });
        // }

        // add sort
        if (settings.sort) {
            form.append('<input type="hidden" id="orderBy" name="orderBy" value="{{ old('orderBy') }}">');
            form.append('<input type="hidden" id="order" name="order" value="{{ old('order') }}">');

            form.find('.sort').css('cursor', 'pointer');

            form.find('.sort').append(
                "<i class='m-r-5 m-l-5 fa {{ request()->query('order') == 'asc' ? 'fa-sort-amount-asc' : ( request()->query('order') == 'desc' ? 'fa-sort-amount-desc' : 'fa-sort') }}' ></i>"
            );

            form.find('.sort').each(function(index, val) {
                if (new URLSearchParams(window.location.search).get('orderBy') == $(val).data('name')) {
                    // $(val).find('i').removeClass('d-none');
                } else {
                    $(val).find('i').removeClass('fa-sort-amount-asc');
                    $(val).find('i').removeClass('fa-sort-amount-desc');
                    $(val).find('i').addClass('fa-sort');
                }
            });

            form.find('.sort').click(function() {
                form.find('#orderBy').val($(this).data('name'));
                @if (request()->query('order') == 'asc')
                    form.find('#order').val('desc');
                @else
                    form.find('#order').val('asc');
                @endif
                form.find(':submit').click();
            });
        }

        // add form to parent
        parent.append(form);

        form.submit(function() {
            form.find(':input').filter(function() {
                return !this.value || this.value == "null" ;//|| this.name == "_token"  || this.name == "_method";
            }).attr('disabled', 'disabled');
        });

    }
</script>
