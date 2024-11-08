const express = require('express');
const router = express.Router();
const { json } = require('express');
const port = process.env.port || 8000;

router.use(json());

router.get('/', (req, res) => {
    res.json({ message: "Hello World!" });
});


router.get('/customer', (req, res) => {
    res.json({ data: "500k" });
});
console.log(`http://localhost:${port}/api/customer`);

module.exports = router;

