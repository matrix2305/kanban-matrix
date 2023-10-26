#!/bin/bash

openapi-generator-cli generate -i http://localhost:9900/docs/api-docs.json -g typescript-axios -o ./src/api-client
