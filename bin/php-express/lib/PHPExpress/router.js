module.exports = function(req, res) {
    const fullUrl = `${req.protocol}://${req.get('host')}${req.originalUrl}`;
    console.info(`request: ${fullUrl}`);
    res.render(req.path.slice(1), {
        method: req.method,
        get: req.query,
        post: req.body,
        url: fullUrl
    });
};