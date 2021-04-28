export const is404 = function(err) {
    return isErrorWithResponeseAndStatuts(err) && 404 === err.response.status;
};

export const is422 = function(err) {
    return isErrorWithResponeseAndStatuts(err) && 422 === err.response.status;
};

const isErrorWithResponeseAndStatuts = function(err) {
    return err.response && err.response.status;
};