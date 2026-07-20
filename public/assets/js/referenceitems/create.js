document.addEventListener('DOMContentLoaded', function () {

    function ReferenceItemViewModel() {
        var self = this;

        self.keyword = ko.observable('');
        self.searchResults = ko.observableArray([]);
        self.selectedTags = ko.observableArray([]);


        // test
        self.tags = ko.observableArray([]);

        self.loadTags = function () {
            fetch('/tags')
                .then(function (response) {
                    return response.json();
                })
                .then(function (tags) {
                    console.log('Fetched tags:', tags);
                    self.tags(tags);
                })
                .catch(function (error) {
                    console.error('Error fetching tags:', error);
                });
        };
        self.loadTags();

        
        self.selectTag = function (tag) {
            self.selectedTags.push(tag);
        };

        self.removeTag = function (tag) {
            self.selectedTags.remove(tag);
        };
    }

    ko.applyBindings(new ReferenceItemViewModel());
});
