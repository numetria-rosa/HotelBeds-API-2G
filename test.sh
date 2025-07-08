#!/bin/bash

# Define API key and secret
apiKey="b9876c76a82ad7f97d384b90e41ecf22"
secret="9747b9d181";

# Get current timestamp in seconds
timestamp=$(date +%s)

# Generate the X-Signature by concatenating apiKey, secret, and timestamp, then hashing it with SHA256
signature=$(echo -n "${apiKey}${secret}${timestamp}" | sha256sum | awk '{ print $1 }')

# Send the GET request with curl, including the API key and X-Signature in the headers
curl -i \
-X GET \
-H "Accept: application/json" \
-H "Api-key: $apiKey" \
-H "X-Signature: $signature" \
"https://api.test.hotelbeds.com/hotel-api/1.0/status"
