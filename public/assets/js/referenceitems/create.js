document.addEventListener('DOMContentLoaded', function () {

    function ReferenceItemViewModel() {
        const self = this;

        self.keyword = ko.observable('');
        self.searchResults = ko.observableArray([]);
        self.selectedTags = ko.observableArray([]);


        self.loadTags = function () {
            fetch('/tags')
                .then(function (response) {
                    return response.json();
                })
                .then(function (tags) {
                    const filterdTags = tags.filter(function (tag) {
                        return !self.selectedTags().some(function (selectedTag) {
                            return selectedTag.id === tag.id;
                        });
                    });
                    self.searchResults(filterdTags);
                })
                .catch(function (error) {
                    console.error('Error fetching tags:', error);
                });
        };

        self.searchTags = function () {
            const keyword = self.keyword().trim();
            if (keyword === '') {
                self.loadTags();
                return;
            }

            const url = '/tags?keyword=' + encodeURIComponent(keyword);
            fetch(url)
                .then(function (response) {
                    return response.json();
                })
                .then(function (results) {
                    const filterdResults = results.filter(function (tag) {
                        return !self.selectedTags().some(function (selectedTag) {
                            return selectedTag.id === tag.id;
                        });
                    });
                    self.searchResults(filterdResults);
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
            self.searchTags();
        };

        self.removeTag = function (tag) {
            self.selectedTags.remove(tag);
            self.searchTags();
        };

        self.loadTags();
    }

    ko.applyBindings(new ReferenceItemViewModel());
});
