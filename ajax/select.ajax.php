<?php
echo json_encode('{
    "results": [
      {
        "id": 1,
        "text": "Option 1"
      },
      {
        "id": 2,
        "text": "Option 2"
      }
    ],
    "pagination": {
      "more": true
    }
  }');