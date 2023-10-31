// Show whether status is visible or hidden during creating the category
function toggleStatus() {
    var checkbox = document.getElementsByName('status')[0];
    var span = document.getElementById('statusSpan');

    if (checkbox.checked) {
        span.textContent = 'Hide';
        span.classList.remove('text-success');
        span.classList.add('text-danger');
    } else {
        span.textContent = 'Visible';
        span.classList.remove('text-danger');
        span.classList.add('text-success');
    }
}

// Show whether popular column is popular or unpopular during creating  the category
function togglePopular() {
    var checkbox = document.getElementsByName('popular')[0];
    var span = document.getElementById('popularSpan');

    if (checkbox.checked) {
        span.textContent = 'Popular';
        span.classList.remove('text-danger');
        span.classList.add('text-success');
    } else {
        span.textContent = 'Unpopular';
        span.classList.remove('text-success');
        span.classList.add('text-danger');
    }
}



// Product page:create view
function toggleTrending() {
    var checkbox = document.getElementsByName('trending')[0];
    var span = document.getElementById('trendingSpan');

    if (checkbox.checked) {
        span.textContent = 'Trending';
        span.classList.remove('text-info');
        span.classList.add('text-success');
    } else {
        span.textContent = 'Common';
        span.classList.remove('text-success');
        span.classList.add('text-info');
    }
}


// Show whether status is visible or hidden during editing the category
function toggleEditStatus(checkbox) {
    var span = document.getElementById('statusSpan');

    if (checkbox.checked) {
        span.textContent = 'Hidden';
        span.classList.remove('text-success');
        span.classList.add('text-danger');
    } else {
        span.textContent = 'Visible';
        span.classList.remove('text-danger');
        span.classList.add('text-success');
    }
}

// Show whether popular column is popular or unpopular during editing the category
function toggleEditPopular(checkbox) {
    var span = document.getElementById('popularSpan');

    if (checkbox.checked) {
        span.textContent = 'Popular';
        span.classList.remove('text-danger');
        span.classList.add('text-success');
    } else {
        span.textContent = 'Unpopular';
        span.classList.remove('text-success');
        span.classList.add('text-danger');
    }
}

// Product page:edit view
function toggleEditTrending(checkbox) {
    var span = document.getElementById('trendingSpan');

    if (checkbox.checked) {
        span.textContent = 'Trending';
        span.classList.remove('text-info');
        span.classList.add('text-success');
    } else {
        span.textContent = 'Common';
        span.classList.remove('text-success');
        span.classList.add('text-info');
    }
}
// order status change
function change_status() {
    var status = document.getElementById('order_status').value;
    var dispatch = document.querySelector('.dispatch');
    var intransit = document.querySelector('.intransit');
    var delivery = document.querySelector('.delivery');

    dispatch.style.display = 'none';
    intransit.style.display = 'none';
    delivery.style.display = 'none';

    if (status === '1') {
        dispatch.style.display = 'block';
    } else if (status === '2') {
        intransit.style.display = 'block';
    } else if (status === '3') {
        delivery.style.display = 'block';
    }
}

//  datepicker script 
$(function() {
    $(".datepicker").datepicker({
        dateFormat: "DD, d MM, yy"
    });
});
