import {mount} from '@vue/test-utils';
import ReturnButton from '@/layout/ReturnButton.vue';

import { describe,it,expect} from 'vitest';


describe("ReturnButton.vue", () => {
    it("renders slot content", () => {
      const wrapper = mount(ReturnButton, {
        slots: {
          default: "<span>Vissza</span>"
        }
      });
      
      expect(wrapper.html()).toContain("<span>Vissza</span>");
    });
    
    it("emits step-back event when clicked", async () => {
      const wrapper = mount(ReturnButton);
      
      await wrapper.find("button").trigger("click");
      
      expect(wrapper.emitted()).toHaveProperty("step-back");
      expect(wrapper.emitted("step-back")).toHaveLength(1);
    });
  }); 

