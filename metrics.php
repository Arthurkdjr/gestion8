<?php
require 'vendor/autoload.php';

use Prometheus\CollectorRegistry;
use Prometheus\Storage\APC;
use Prometheus\RenderTextFormat;

// Initialise le registre des métriques
$registry = new CollectorRegistry(new APC());

// Exemple de métrique : compteur de requêtes HTTP
$counter = $registry->getOrRegisterCounter(
    'my_app', // Namespace
    'http_requests_total', // Nom de la métrique
    'Total HTTP requests', // Description
    ['method', 'endpoint'] // Labels (méthode HTTP et endpoint)
);

// Incrémente le compteur pour chaque requête
$counter->inc(['GET', '/']);

// Renvoie les métriques au format Prometheus
header('Content-Type: text/plain');
echo (new RenderTextFormat())->render($registry->getMetricFamilySamples());