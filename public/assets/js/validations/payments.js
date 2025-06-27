$('#sampleTable').DataTable({
    "footerCallback": function (row, data, start, end, display) {
        var api = this.api();

        var intVal = function (i) {
            return typeof i === 'string'
                ? parseFloat(i.replace(/[^0-9.-]+/g, '')) || 0
                : typeof i === 'number'
                    ? i
                    : 0;
        };

        // Fix: Use correct column index for "Amount" = 6
        var pageTotal = api
            .column(6, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Display below Amount column (index 6)
        $(api.column(6).footer()).html(
            '₹' + pageTotal.toLocaleString('en-IN', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })
        );
    }
});
