# document_manage
Este Repositorio é para criar um gestor de documento para empresas !


# Projeto de Criptografia e Banco de Dados

Este projeto demonstra como criptografar e descriptografar dados usando o algoritmo AES-256, além de interagir com um banco de dados MySQL de forma segura.

## 1. Funções de Criptografia

As funções `encrypt` e `decrypt` são utilizadas para criptografar e descriptografar dados usando o algoritmo AES-256. 

### Exemplo de Implementação

```php
function encrypt($data, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decrypt($data, $key) {
    $data = base64_decode($data);
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $iv_length);
    $encrypted = substr($data, $iv_length);
    return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
}

###  Validação de Entrada
O ID recebido da URL é validado para garantir que seja um número inteiro.

Exemplo de Implementação

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ID inválido.");
}


## Os dados recuperados do banco de dados são criptografados e descriptografados antes de serem exibidos ao usuário.

$stmt = $conn->prepare("SELECT * FROM tabela WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Processar os dados
} else {
    echo "Nenhum resultado encontrado.";
}



$dados = $row['dados']; // Supondo que 'dados' seja a coluna que você deseja criptografar
$chave = hash('sha256', 'sua-chave-secreta');

$dados_criptografados = encrypt($dados, $chave);
$dados_descriptografados = decrypt($dados_criptografados, $chave);

echo "Dados Criptografados: " . $dados_criptografados;
echo "Dados Descriptografados: " . $dados_descriptografados;
