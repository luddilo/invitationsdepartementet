<div class="row">
    <div class="form-group col-sm-4">
        <a class="btn btn-success btn-xs" href id="toggleFilters">Visa filter</a>
        <span id="numOfActiveFilters"></span>
        <a href style="text-decoration: underline" id="clearFilters">(Rensa filter)</a>
        <a href class="btn btn-success btn-xs" id="saveSearch"> Spara filter</a>
    </div>
</div>
<div class="row">
    <div id="filters" class="collapse">
        @foreach ($filters as $name => $filter)
            <div class="form-group col-sm-3">
                {!! Form::label($name, trans('general.' . $name)) !!}
                {!! Form::select($name, $filter, isset($params[$name]) ? $params[$name] : null, ['class' => 'form-control filter']) !!}
            </div>
        @endforeach
    </div>
</div>

<div class="row" style="margin-top: 50px">
    <div class="col-sm-12">
        <table id="users-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                    @foreach($columns as $column)
                        <th class="{!! $column['classes'] or '' !!}">
                            {!! $column['displayName'] or '' !!}</th>
                    @endforeach
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">

        $(function() {

            var params = [];

            @foreach($params as $name => $value)
                params.push({
                    'name': '{!! $name !!}',
                    'value': '{!! $value !!}'
                });
            @endforeach

            setAmountOfFilters();

            $('#toggleFilters').on('click', function(e){
                e.preventDefault();
                $('#filters').toggle();
                if ($('#filters').is(':visible')){
                    $('#toggleFilters').text('Göm filter');
                    $('#toggleFilters').addClass('btn-warning');
                }
                else {
                    $('#toggleFilters').text('Visa filter');
                    $('#toggleFilters').removeClass('btn-warning');
                }
            });

            $('.filter').on('change', function(e){
                e.preventDefault();
                filterUsers(this, true);
                $('#users-table').DataTable().ajax.reload();
            });

            $('#clearFilters').on('click', function(e){
                e.preventDefault();
                $.get('{!! $clearSearchRoute !!}', {}, function() {
                    resetFilters();
                    removeQueryParametersAndReload();
                    setAmountOfFilters();
                });
            });

            $("#saveSearch").on('click', function(e) {
               e.preventDefault();
               $.get('{!! $saveSearchRoute !!}', params);
            });

            function resetFilters(){
                $.each($('.filter'), function(index, filter){
                    filter.value = 99;
                    filterUsers(filter, false);
                })
            }

            function removeQueryParametersAndReload(){
                url = removeAllQueryStringParameters(window.location.href);
                window.history.pushState({}, '', url);
                $('#users-table').DataTable().ajax.reload();
            }
            function setAmountOfFilters(){
                $('#numOfActiveFilters').text(params.length + " aktiva filter");

                if (params.length > 0){
                    $('#clearFilters,#saveSearch').show();
                }
                else {
                    $('#clearFilters,#saveSearch').hide();
                }

            }

            function updateQueryStringParameter(uri, key, value) {
                var re = new RegExp("([?|&])" + key + "=.*?(&|#|$)", "i");
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    var hash =  '';
                    if( uri.indexOf('#') !== -1 ){
                        hash = uri.replace(/.*#/, '#');
                        uri = uri.replace(/#.*/, '');
                    }
                    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                    return uri + separator + key + "=" + value + hash;
                }
            }

            function removeQueryStringParameter(uri, key) {
                var re = new RegExp("([?|&])" + key + "=.*?(&|#|$)", "i");
                if (uri.match(re)) {
                    var stripped = uri.replace(re, '$1' + '$2');
                    var re2 = /(&+)/;
                    var re3 = /\?\&/;
                    var re5 = /(\&+$)|(\?$)/;
                    stripped = stripped.replace(re2, '&');
                    stripped = stripped.replace(re3, '?');
                    stripped = stripped.replace(re5, '');
                    return stripped;
                }
            }

            function removeAllQueryStringParameters(uri){
                return uri.split(/[?#]/)[0];
            }

            function filterUsers(filter, executeInstantly) {
                params = params.filter(function(item){
                    return item.name != filter.name;
                });

                url = window.location.href;

                if (filter.value != 99) {
                    params.push({
                        'name': filter.name,
                        'value': filter.value
                    });

                    url = updateQueryStringParameter(url, filter.name, filter.value);
                }
                else {
                    url = removeQueryStringParameter(url, filter.name)
                }

                if (executeInstantly) {
                    if (url != window.location.href){
                        window.history.pushState({}, '', url);
                    }
                    setAmountOfFilters();
                }

            }

            $('#users-table').DataTable({
                processing: true,
                //serverSide: true,
                ajax: {
                    url: '{!! $dataTableRoute !!}',
                    dataSrc: '',
                    type: 'GET',
                    data: function(data){
                        params.forEach(function(param){
                            data[param.name] = param.value;
                        });
                    }
                },
                columns: {!! json_encode($dataColumns) !!}.map(function(obj) {
                    if (obj.data == 'phone') {
                        obj.render = function (data, type, row) {
                            var nospaces = data.replace(/\s/g, '');
                            data = data + '<span class="hidden">' + nospaces + '</span>';
                            return data;
                        };
                    }

                    return obj;
                }),

                order: new Array(),
                columnDefs: [
                    { "targets"  : 'no-sort', "orderable": false, "searchable": false }
                ],
                paging: true,
                lengthMenu: [15, 50, 100],
                pageLength: 15,
                stateSave: true,
                language: {
                    "decimal":        "",
                    "emptyTable":     "Inga deltagare funna",
                    "info":           "Visar _START_ till _END_ av _TOTAL_ deltagare",
                    "infoEmpty":      "Visar 0 av 0 personer",
                    "infoFiltered":   "(filtrerat från _MAX_ totala deltagare)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Visa _MENU_ personer",
                    "loadingRecords": "Laddar...",
                    "processing":     "Hämtar deltagare...",
                    "search":         "Sök:",
                    "zeroRecords":    "Inga matchade deltagare funna",
                    "paginate": {
                        "first":      "Första",
                        "last":       "Sista",
                        "next":       "Nästa",
                        "previous":   "Föregående"
                    },
                    "aria": {
                        "sortAscending":  ": aktivera för att sortera stigande",
                        "sortDescending": ": aktivera för att sortera sjunkande"
                    }
                }
            });

            $("#users-table").on('click', 'tbody tr', function () {
                var id = $(this).children('td').first().html();
                window.location.href = '{!! route('app.users.index') !!}/' + id;
            });
        });


    </script>
@endpush
