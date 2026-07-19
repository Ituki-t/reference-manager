console.log('ReferenceItemViewModel initialized');

document.addEventListener('DOMContentLoaded', function () {

    function ReferenceItemViewModel() {
        var self = this;

        self.keyword = ko.observable('');
        self.searchResults = ko.observableArray([]);
        self.selectedTags = ko.observableArray([]);
    }

    ko.applyBindings(new ReferenceItemViewModel());
});
