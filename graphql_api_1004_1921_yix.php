<?php
// 代码生成时间: 2025-10-04 19:21:48
// graphql_api.php
// This file demonstrates a simple GraphQL API implementation using CakePHP and webonyx/graphql-php.

use Cake\Http\Exception\NotFoundException;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\NonNull;

// Define a custom scalar type for JSON data.
class JsonScalarType extends ScalarType {
    public $name = 'JSON';

    public function serialize($value) {
        return json_encode($value);
    }

    public function parseValue($value) {
        return json_decode($value);
    }

    public function parseLiteral($valueNode, array $variables = null) {
        return json_decode($valueNode->value);
    }
}

// Define the Query type.
$rootQuery = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'hello' => [
            'type' => Type::string(),
            'description' => 'A simple type for getting started with GraphQL!',
            'resolve' => function () {
                return 'Hello, world!';
            },
        ],
        'jsonExample' => [
            'type' => new NonNull(new JsonScalarType()),
            'description' => 'An example field that returns JSON data.',
            'resolve' => function () {
                return [
                    'key' => 'value',
                    'more' => 'data',
                ];
            },
        ],
    ],
]);

// Define the schema.
$schema = new Schema(['query' => $rootQuery]);

// Define the route for the GraphQL API.
Router::scope('/api', function (RouteBuilder $builder) {
    $builder->connect('/graphql', ['controller' => 'GraphQL', 'action' => 'execute']);
});

// Define the controller for the GraphQL API.
class GraphQLController extends AppController {
    public function execute() {
        try {
            $request = $this->request;
            $input = $request->getData();
            $query = $request->getData('query');
            $variables = $request->getData('variables') ?? null;

            $result = GraphQL::executeQuery(
                $this->getSchema(),
                $query,
                $variables,
                null, // rootValue
                null, // context
                $request->getData('operationName'),
                [], // field resolver
                $variables
            );

            $output = $result->toArray();
            $this->set($output);
            $this->set([
                '_serialize' => ['data' => $output['data'], 'errors' => $output['errors']],
            ]);
        } catch (\Exception $e) {
            throw new NotFoundException($e->getMessage());
        }
    }

    protected function getSchema() {
        return $schema;
    }
}
