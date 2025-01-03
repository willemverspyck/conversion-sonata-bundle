<?php

declare(strict_types=1);

namespace Spyck\ConversionSonataBundle\Admin;

use Spyck\SonataExtension\Admin\AbstractAdmin as BaseAbstractAdmin;
use Spyck\SonataExtension\Security\SecurityInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class AbstractAdmin extends BaseAbstractAdmin implements SecurityInterface
{
    #[Required]
    public function setServiceTranslation(): void
    {
        $this->setTranslationDomain('SpyckConversionSonataBundle');
    }

    public function getRole(): ?string
    {
        return strtoupper($this->getBaseRouteName());
    }

    protected function configureDefaultSortValues(array &$sortValues): void
    {
        $sortValues['_sort_order'] = 'DESC';
        $sortValues['_sort_by'] = 'id';
    }

    protected function getRemoveRoutes(): iterable
    {
        yield 'delete';
    }

    protected function isInstanceOf(string $instanceOf): bool
    {
        $classes = array_keys($this->getConfigurationPool()->getAdminClasses());

        foreach ($classes as $class) {
            if (is_a($class, $instanceOf, true)) {
                return true;
            }
        }

        return false;
    }
}
