<?php

namespace App;

enum ExpenseCategory: string
{
    case FUEL = 'fuel';
    case MAINTENANCE = 'maintenance';
    case REPAIR = 'repair';
    case DOCUMENTATION = 'documentation';
    case INSURANCE = 'insurance';
    case PARKING_AND_TOLL = 'parking_and_toll';
    case CLEANING_AND_CARE = 'cleaning_and_care';
    case ACCESSORIES_AND_CUSTOM = 'accessories_and_custom';
    case FINES_AND_FEES = 'fines_and_fees';
    case LOANS = 'loans';

    case RENTAL = 'rental';
    case OTHERS = 'others';

    /**
     * Retorna a descrição da categoria
     */
    public function description(): string
    {
        return match($this) {
            self::FUEL => 'Combustível',
            self::MAINTENANCE => 'Manutenção',
            self::REPAIR => 'Conserto/Reparo',
            self::DOCUMENTATION => 'Documentação',
            self::INSURANCE => 'Seguro',
            self::PARKING_AND_TOLL => 'Estacionamento e Pedágio',
            self::CLEANING_AND_CARE => 'Limpeza e Conservação',
            self::ACCESSORIES_AND_CUSTOM => 'Acessórios e Personalização',
            self::FINES_AND_FEES => 'Multas e Taxas',
            self::LOANS => 'Financiamento',
            self::RENTAL => 'Aluguel',
            self::OTHERS => 'Outras',
        };
    }

    /**
     * Retorna a cor da categoria para uso no Filament
     */
    public function color(): string
    {
        return match($this) {
            self::FUEL => 'primary',
            self::MAINTENANCE => 'warning',
            self::REPAIR => 'danger',
            self::DOCUMENTATION => 'info',
            self::INSURANCE => 'success',
            self::PARKING_AND_TOLL => 'teal',
            self::CLEANING_AND_CARE => 'fuchsia',
            self::ACCESSORIES_AND_CUSTOM => 'violet',
            self::FINES_AND_FEES => 'orange',
            self::LOANS => 'lime',
            self::RENTAL => 'indigo',
            self::OTHERS => 'slate',
        };
    }

    /**
     * Retorna o ícone do Heroicons correspondente à categoria
     */
    public function icon(): string
    {
        return match($this) {
            self::FUEL => 'fas-gas-pump',
            self::MAINTENANCE => 'heroicon-s-wrench',
            self::REPAIR => 'heroicon-s-cog',
            self::DOCUMENTATION => 'heroicon-s-document-text',
            self::INSURANCE => 'heroicon-s-shield-check',
            self::PARKING_AND_TOLL => 'heroicon-s-truck',
            self::CLEANING_AND_CARE => 'heroicon-s-sparkles',
            self::ACCESSORIES_AND_CUSTOM => 'heroicon-s-cog-6-tooth',
            self::FINES_AND_FEES => 'heroicon-s-exclamation-circle',
            self::LOANS => 'heroicon-s-banknotes',
            self::RENTAL => 'heroicon-s-tag',
            self::OTHERS => 'heroicon-s-ellipsis-horizontal',
        };
    }

    /**
     * Retorna um array com todos os valores no formato ['label' => 'description']
     */
    public static function toArray(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->description()];
        })->toArray();
    }

    /**
     * Retorna a descrição com base no valor (label) armazenado no banco
     */
    public static function getDescriptionFromLabel(string $label): string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $label) {
                return $case->description();
            }
        }
        return 'Categoria desconhecida'; // Retorno padrão caso não encontre
    }

    public static function getColorFromLabel(string $label): string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $label) {
                return $case->color();
            }
        }
        return 'gray'; // Cor padrão para valores desconhecidos
    }

    public static function getIconFromLabel(string $label): string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $label) {
                return $case->icon();
            }
        }
        return 'heroicon-s-question-mark-circle';
    }
}
