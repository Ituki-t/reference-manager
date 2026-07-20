document.addEventListener('DOMContentLoaded', function () {

    function ReferenceItemViewModel() {
        const self = this;

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


        self.searchTags = function () {
            const keyword = self.keyword().trim();
            if (keyword === '') {
                self.searchResults([]);
                return;
            }

            const url = '/tags?keyword=' + encodeURIComponent(keyword);
            fetch(url)
                .then(function (response) {
                    return response.json();
                })
                .then(function (results) {
                    self.searchResults(results);
                })
                .catch(function (error) {
                    console.error('Error searching tags:', error);
                });
        };

        self.keyword.subscribe(function () {
            self.searchTags();
        });

        
        self.selectTag = function (tag) {
            self.selectedTags.push(tag);
        };

        self.removeTag = function (tag) {
            self.selectedTags.remove(tag);
        };
    }

    ko.applyBindings(new ReferenceItemViewModel());
});
