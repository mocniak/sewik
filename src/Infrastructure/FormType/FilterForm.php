<?php

namespace Sewik\Infrastructure\FormType;

use Sewik\Domain\AccidentsFilterDto;
use Sewik\Domain\Filter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voivodeship', ChoiceType::class, [
                'required' => false,
                'label' => 'Województwo',
                'choices' => Filter::VOIVODESHIPS
            ])
            ->add('county', ChoiceType::class, [
                'required' => false,
                'label' => 'Powiat',
                'choices' => Filter::COUNTIES
            ])
            ->add('locality', TextType::class, ['required' => false, 'label' => 'Miejscowość'])
            ->add('street', TextType::class, ['required' => false, 'label' => 'Ulica'])
            ->add('fromDate', DateType::class, [
                'required' => false,
                'label' => 'Od dnia',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['placeholder' => 'yyyy-mm-dd']
            ])
            ->add('toDate', DateType::class, [
                'required' => false,
                'label' => 'Do dnia',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['placeholder' => 'yyyy-mm-dd']
            ])
            ->add('accidentType', ChoiceType::class, [
                'required' => false,
                'label' => 'Rodzaj wypadku',
                'choices' => Filter::ACCIDENT_TYPES
            ])
            ->add('injury', ChoiceType::class, [
                'required' => false,
                'label' => 'Obrażenia ofiar',
                'choices' => Filter::PARTICIPANT_INJURIES
            ])
            ->add('vehicleType', ChoiceType::class, [
                'required' => false,
                'label' => 'Zdarzenia w których brał udział typ pojazdu',
                'expanded' => true,
                'multiple' => true,
                'choices' => Filter::VEHICLE_TYPES
            ])
            ->add('accidents', SubmitType::class, array('label' => 'Wyświetl zdarzenia'))
            ->add('reports', SubmitType::class, array('label' => 'Wyświetl raporty'));

        $callbackTransformer = new CallbackTransformer(
            function (?\DateTimeImmutable $dateTimeImmutable) {
                if (null === $dateTimeImmutable) return null;
                $dateTime = new \DateTime(null, $dateTimeImmutable->getTimezone());
                $dateTime->setTimestamp($dateTimeImmutable->getTimestamp());
                return $dateTime;
            },
            function (?\DateTime $dateTimeMutableDate) {
                if (null === $dateTimeMutableDate) return null;
                $dateTimeImmutable = \DateTimeImmutable::createFromMutable($dateTimeMutableDate);
                return $dateTimeImmutable;
            }
        );

        $builder->get('fromDate')
            ->addModelTransformer($callbackTransformer);
        $builder->get('toDate')
            ->addModelTransformer($callbackTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AccidentsFilterDto::class,
        ));
    }
}