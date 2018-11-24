
app.controller('dashboard',function($scope){
    $scope.page = "Dashboard page";
	
	 $(document).ready(function () {
		 console.log("documentready");
        var crudServiceBaseUrl = "https://demos.telerik.com/kendo-ui/service",
            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url: crudServiceBaseUrl + "/Products",
                        dataType: "jsonp"
                    },
                    update: {
                        url: crudServiceBaseUrl + "/Products/Update",
                        dataType: "jsonp"
                    },
                    destroy: {
                        url: crudServiceBaseUrl + "/Products/Destroy",
                        dataType: "jsonp"
                    },
                    create: {
                        url: crudServiceBaseUrl + "/Products/Create",
                        dataType: "jsonp"
                    },
                    parameterMap: function(options, operation) {
                        if (operation !== "read" && options.models) {
                            return {models: kendo.stringify(options.models)};
                        }
                    }
                },
                batch: true,
                pageSize: 20,
                schema: {
                    model: {
                        id: "ProductID",
                        fields: {
                            ProductID: { editable: false, nullable: true },
                            ProductName: { validation: { required: true } },
                            UnitPrice: { type: "number", validation: { required: true, min: 1} },
                            Discontinued: { type: "boolean" },
                            UnitsInStock: { type: "number", validation: { min: 0, required: true } }
                        }
                    }
                }
            });

        $("#grid").kendoGrid({
            dataSource: dataSource,
            pageable: true,
            height: 550,
            toolbar: ["create"],
            columns: [
                { field:"ProductName", title: "Product Name" },
                { field: "UnitPrice", title:"Unit Price", format: "{0:c}", width: "120px" },
                { field: "UnitsInStock", title:"Units In Stock", width: "120px" },
                { field: "Discontinued", width: "120px", editor: customBoolEditor },
                { command: ["edit", "destroy"], title: "&nbsp;", width: "250px" }],
            editable: "popup"
        });
    });

    function customBoolEditor(container, options) {
        var guid = kendo.guid();
        $('<input class="k-checkbox" id="' + guid + '" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
        $('<label class="k-checkbox-label" for="' + guid + '">&#8203;</label>').appendTo(container);
    }

}).controller('registration',function($scope){
    $scope.page = "Registration";

});