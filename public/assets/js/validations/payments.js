$('#sampleTable').DataTable({
    "footerCallback": function (row, data, start, end, display) {
        var api = this.api();

        // Helper function to parse and clean numbers
        var intVal = function (i) {
            return typeof i === 'string'
                ? parseFloat(i.replace(/[^0-9.-]+/g, '')) || 0
                : typeof i === 'number'
                    ? i
                    : 0;
        };

        // Total over current page
        var pageTotal = api
            .column(4, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(4).footer()).html(
            pageTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })
        );
    }
});