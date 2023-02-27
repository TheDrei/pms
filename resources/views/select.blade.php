<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css') }}">
</head>
<body>
<div class="container">
        <div class="col-4">
            <h4>Data (single select)</h4>
             <div class="col-4">
            <h4>Filter / search</h4>
            <select class="custom-select" id="filtering">
                <option value="cheese">Cheese</option>
                <option value="tomatoes">Tomatoes</option>
                <option value="mozzarella">Mozzarella</option>
                <option value="mushrooms">Mushrooms</option>
                <option value="pepperoni">Pepperoni</option>
                <option value="onions">Onions</option>
                <option value="bacon">Bacon</option>
                <option value="potatoes">Potatoes</option>
            </select>
        </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>

<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js') }}"></script>
<script type="text/javascript">
$('#filtering').multiselect({
    nonSelectedText: 'Select a food...',
    enableFiltering: true,
    templates: {
        li: '<li><a href="javascript:void(0);"><label class="pl-2"></label></a></li>',
        filter: '<li class="multiselect-item filter"><div class="input-group m-0 mb-1"><input class="form-control multiselect-search" type="text"></div></li>',
        filterClearBtn: '<div class="input-group-append"><button class="btn btn btn-outline-secondary multiselect-clear-filter" type="button"><i class="fa fa-close"></i></button></div>'
    },
    selectedClass: 'bg-light',
    onInitialized: function(select, container) {
        // hide checkboxes
        container.find('input[type=checkbox]').addClass('d-none');
    }
});
$('input[type=radio]').addClass('d-none');

</script>
</html>