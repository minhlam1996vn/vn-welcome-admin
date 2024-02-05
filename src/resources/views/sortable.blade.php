<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>JS Bin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>

<style>
    .list-group-item:hover {
        background-color: rgba(0, 0, 0, 0.1)
    }
</style>

<body>
    <div class="container mt-5">
        <div id="demo" class="mb-2">
            <div id="list-sort" class="list-group col">
                <div data-id="1" class="list-group-item nested-1 rounded shadow mb-2">Item 1</div>
                <div data-id="2" class="list-group-item nested-1 rounded shadow mb-2">Item 2</div>
                <div data-id="3" class="list-group-item nested-1 rounded shadow mb-2">Item 3</div>
                <div data-id="4" class="list-group-item nested-1 rounded shadow mb-2">Item 4</div>
                <div data-id="5" class="list-group-item nested-1 rounded shadow mb-2">Item 5</div>
                <div data-id="6" class="list-group-item nested-2 rounded shadow mb-2">
                    <div class="mb-2">
                        Item 6
                    </div>
                    <div class="list-group px-2" id="list-sort-6">
                        <div data-id="7" class="d-none list-group-item nested-3 rounded shadow mb-2">Item 3.1</div>
                        <div data-id="8" class="list-group-item nested-3 rounded shadow mb-2">Item 3.2</div>
                        <div data-id="9" class="list-group-item nested-3 rounded shadow mb-2">Item 3.3</div>
                        <div data-id="10" class="list-group-item nested-3 rounded shadow mb-2">Item 3.4</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button id="get-order" class="btn btn-primary">Get Order</button>
        </div>
    </div>

    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>
        // List 1
        $('#list-sort').sortable({
            group: {
                name: 'list',
                pull: 'clone',
                put: false,
            },
            animation: 200,
            // ghostClass: 'bg-primary',
            onSort: reportActivity,
        });

        // List 2 (nested)
        $('#list-sort-6').sortable({
            group: {
                name: 'list',
                pull: 'clone',
                put: false,
            },
            animation: 200,
            // ghostClass: 'bg-primary',
            onSort: reportActivity,
        });

        // Arrays of "data-id"
        $('#get-order').click(function() {
            // const sortValue = $('#list-sort').sortable('toArray');
            // console.log(sortValue);
            const sortValue = getNestedSortOrder('#list-sort');
            console.log(sortValue);
        });

        // Report when the sort order has changed
        function reportActivity() {
            console.log('The sort order has changed');
        };

        // get nested sort order
        function getNestedSortOrder(selector) {
            const result = [];

            $(selector).find('> .list-group-item').each(function() {
                const item = {
                    id: $(this).data('id'),
                    children: getNestedSortOrder($(this).find('.list-group'))
                };

                result.push(item);
            });

            return result;
        }
    </script>

</body>

</html>
