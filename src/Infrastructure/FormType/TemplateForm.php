<?php
namespace Sewik\Infrastructure\FormType;

use Ramsey\Uuid\Uuid;
use Sewik\Application\Request\EditTemplateRequest;
use Sewik\Domain\Entity\QueryTemplate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemplateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('templateId', HiddenType::class)
            ->add('name')
            ->add('category', ChoiceType::class, [
                'choices' => QueryTemplate::CATEGORIES
            ])
            ->add('sqlQuery', TextareaType::class)
            ->add('save', SubmitType::class);
        $builder->get('templateId')
            ->addModelTransformer(new CallbackTransformer(
                function ($uuidId) {
                    return ($uuidId === null) ? null : $uuidId->toString();
                },
                function ($idAsString) {
                    return Uuid::fromString($idAsString);
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EditTemplateRequest::class,
        ));
    }
}
