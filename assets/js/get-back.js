$(document).ready(function() {

    // Custom history management object
    var urlHistory = {
        historyData: [],

        // Function to add an entry to the historyData and store it in local storage
        addEntry: function(url, requestType) {
            var entry = { url: url, requestType: requestType };
            this.historyData.push(entry);
            this.saveHistoryData(); // Store in local storage
        },

        // Function to get the previous entry and update local storage
        getPreviousEntry: function() {
            while (this.historyData.length > 0) {
                var previousEntry = this.historyData.pop();
                if (previousEntry.url !== currentURL) {
                    this.saveHistoryData(); // Update local storage
                    return previousEntry;
                }
            }
            return null;
        },

        // Function to save the history data to local storage
        saveHistoryData: function() {
            localStorage.setItem('urlHistory', JSON.stringify(this.historyData));
        },

        // Function to load the history data from local storage
        loadHistoryData: function() {
            var storedData = localStorage.getItem('urlHistory');
            if (storedData) {
                this.historyData = JSON.parse(storedData);
            }
        }
    };

    // Load the history data from local storage when the script runs
    urlHistory.loadHistoryData();

    if(requestMethod=="get")
    {
        // Capture and store the request type and URL when the page loads
        var currentURL = window.location.href;
        var currentRequestType = "GET"; // You should determine the actual request type here
        urlHistory.addEntry(currentURL, currentRequestType);
    }

    // Get the "Go Back" button element by its ID
    var goBackButton = $(".get_back");

    // Add a click event listener to the button
    goBackButton.on("click", function() {
        // Get the previous entry from custom history
        var previousEntry = urlHistory.getPreviousEntry();

        if (previousEntry) {
            // Navigate to the previous URL
            window.location.href = previousEntry.url;
        } else {
            // If there is no previous entry, go back one step in the history
            window.history.back();
        }
    });
});
