const express = require('express');
const router = express.Router();

router.get('/', (req, res) => {
  res.json({ message: 'Welcome to the Customer API!' });
});

router.get('/info', (req, res) => {
  res.json({ data: "500k" });
});

module.exports = router;
