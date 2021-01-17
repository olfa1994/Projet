<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;


class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label'=>'Titre'])
            ->add('description', null, ['label'=>'Description'])
            ->add('surface', null, ['label'=>'Surface'])
            ->add('ville')
            ->add('rooms', null, ['label'=>'Nombre de pièces'])
            ->add('bedrooms', null, ['label'=>'Nombre de chambre'])
            ->add('floor', null, ['label'=>'Etage'])
            ->add('price', null, ['label'=>'Prix'])
            ->add('heat' , ChoiceType::class,['label'=>'Chauffage', 'choices'=>$this->getChoices()] )
            ->add('address')
            ->add('postal_code',  null, ['label'=>'Code Postal'])
            ->add('sold',  null, ['label'=>'Marquez comme vendu/loué'])
            ->add('location')
            ->add('type', ChoiceType::class, ['label'=>'Type du bien','choices'=>$this->getTypes()]  )
            ->add('path',FileType::class, [
                'mapped' => false,
                'required' => false,
                'label'=>' Image',
                'constraints' => [
                    new Image()
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
    private function getChoices(){
        $choices = Property::HEAT;
        $output =[];
        foreach ($choices as $k =>$v){
            $output[$v]=$k;
        }
        return $output;
    }

    private function getTypes()
    {
        $choices = Property::TYPE;
        $output =[];
        $i=0;
        foreach ($choices as $k){
            $output[$k]=$k;
            $i++;
        }
        return $output;
    }

}
