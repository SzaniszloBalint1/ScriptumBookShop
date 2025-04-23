import {mount} from '@vue/test-utils';
import Item from '@/components/Books/Item.vue';

import { describe,it,expect,vi,beforeEach } from 'vitest';


const mockStore={
    getters:{
        'book/books':[
          {id:1,title:'Book 1',author:'Author 1',price:100},
          {id:2,title:'Book 2',author:'Author 2',price:200},
        ],
        'book/hasBooks':true
    },
    dispatch:vi.fn()
};


const createWrapper=()=>{
    return mount(Item,{
        global:{
            mocks:{
                $store:mockStore
            }
        }
    });
};


describe('Item.vue',()=>{
    beforeEach(()=>{
        mockStore.dispatch.mockClear();
    });

    it('should render book title',()=>{
        const wrapper=createWrapper();
        expect(wrapper.text()).toContain('Book 1');
    });

    it('should render h3 title',()=>{
        const wrapper=createWrapper();
        expect(wrapper.find('h3').text()).toContain('További könyvek');
    });

    it('should render a description when there are no books',()=>{
        mockStore.getters['book/hasBooks']=false;
        const wrapper=createWrapper();
        expect(wrapper.text()).toContain('Nincs könyv adat amit megjelenítsünk');
    });
});



