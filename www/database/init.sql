CREATE TABLE `logs` (
`created_at` DATETIME NOT NULL DEFAULT NOW(),
`text` TEXT,
INDEX logs_created_at (`created_at`)
)
