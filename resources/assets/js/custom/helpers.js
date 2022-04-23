'use strict';

window.isEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

window.randomCode = (length = 6) => {
    return Math.random().toString(36).slice(-length);
};
