<?php

namespace Sewik\Infrastructure\FormType;

use Sewik\Domain\AccidentsFilterDto;
use Sewik\Domain\Filter;
use Sewik\Domain\Query;
use Sewik\Domain\QueryTemplate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('county', DatalistType::class, [
                'required' => false,
                'label' => 'Powiat',
                'choices' => Filter::COUNTIES
            ])
            ->add('locality', TextType::class, ['required' => false, 'label' => 'Miejscowość'])
            ->add('streets', CollectionType::class, [
                'label' => 'Ulice',
                'required' => false,
                'entry_type' => TextType::class
            ])
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
                'label' => 'Rodzaj zdarzenia',
                'choices' => Filter::ACCIDENT_TYPES
            ])
            ->add('accidentSite', ChoiceType::class, [
                'required' => false,
                'label' => 'Miejsce zdarzenia',
                'choices' => Filter::ACCIDENT_SITE
            ])
            ->add('roadType', ChoiceType::class, [
                'required' => false,
                'label' => 'Rodzaj drogi',
                'choices' => Filter::ACCIDENT_ROAD_TYPE
            ])
            ->add('light', ChoiceType::class, [
                'required' => false,
                'label' => 'Warunki oświetleniowe',
                'choices' => Filter::ACCIDENT_LIGHT
            ])
            ->add('trafficLights', ChoiceType::class, [
                'required' => false,
                'label' => 'Sygnalizacja świetlna',
                'choices' => Filter::ACCIDENT_TRAFFIC_LIGHT
            ])
            ->add('intersectionType', ChoiceType::class, [
                'required' => false,
                'label' => 'Rodzaj skrzyżowania',
                'choices' => Filter::ACCIDENT_INTERSECTION_TYPE
            ])
            ->add('injury', ChoiceType::class, [
                'required' => false,
                'label' => 'W których ofiary odniosły obrażenia',
                'choices' => Filter::PARTICIPANT_INJURIES
            ])
            ->add('driversCause', ChoiceType::class, [
                'required' => false,
                'label' => 'Z winy kierujących',
                'choices' => Filter::DRIVERS_CAUSES
            ])
            ->add('pedestriansCause', ChoiceType::class, [
                'required' => false,
                'label' => 'Z winy pieszych',
                'choices' => Filter::PEDESTRIAN_CAUSES
            ])
            ->add('otherCause', ChoiceType::class, [
                'required' => false,
                'label' => 'Z innych przyczyn',
                'choices' => Filter::ACCIDENT_OTHER_CAUSES
            ])
            ->add('pedestriansPresence', ChoiceType::class, [
                'required' => false,
                'label' => 'Z udziałem pieszych',
                'choices' => ['tak' => true, 'nie' => false]
            ])
            ->add('vehicleType', ChoiceType::class, [
                'required' => false,
                'label' => 'Zdarzenia z pojazdami typu',
                'expanded' => true,
                'multiple' => true,
                'choices' => Filter::VEHICLE_TYPES
            ])
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
